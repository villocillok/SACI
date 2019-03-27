import struct
"""
h0 = 0x67452301
h1 = 0xEFCDAB89
h2 = 0x98BADCFE
h3 = 0x10325476
h4 = 0xC3D2E1F0
"""

h0 = 0x00000000
h1 = 0x00000000
h2 = 0x00000000
h3 = 0x00000000
h4 = 0x00000000


message = "\x00"*64

msg_byte_length = len(message)

print("Original message is: {}\nLength in bits: {}".format(
	message.encode("latin-1"),
	msg_byte_length*8
))
#appending bit '1' 0x80 
message += '\x80'
print("Appending b'\\x80'; New Message is : {}\n".format(message.encode("latin-1")))

#appending bit 0s
_0_appends = ((56 - (msg_byte_length + 1) % 64) % 64)
print("Appending [{}] \\x00s: ".format(_0_appends),end="")
message += '\x00' * _0_appends
print(message.encode())
print("")

#appending msg length, 8 bytes (64 bits)
print("Appending Original Message Length: {}".format(struct.pack('>Q', msg_byte_length*8)))
message += struct.pack('>Q', msg_byte_length*8).decode('latin-1')

#dividing into 512 bit chunks
chunks = []

#512bits = 64 bytes
for i in range(int(len(message)/64)):
	chunks.append(message[(i*64):((i+1)*64)])

#loop for each chunks
for chunk in chunks:
	_32b_words = []
	
	#getting the first 16 words of 80
	for i in range(16):
		#print(chunk[(i*4):((i+1)*4)].encode('latin-1'))
		_32b_words.append(struct.unpack(">I",(chunk[(i*4):((i+1)*4)]).encode('latin-1'))[0])
		
	print(_32b_words[3])
	for i in range(16,80):
		word = (_32b_words[i-3] ^ _32b_words[i-8] ^ _32b_words[i-14] ^ _32b_words[i-16])
		word = ((word << 1) | (word>> 31)) & 0xffffffff
		_32b_words.append(word)
	
	#print(len(_32b_words))
		
	a = h0
	b = h1
	c = h2
	d = h3
	e = h4

	print("""
		a = {}, b = {}, c = {}, d = {}, e = {}
	""".format(
		h0, h1, h2, h3, h4
		))
	
	#main loop 1..n..80 rounds
	for i in range(80):
		if 0 <= i <= 19:
			f = d ^ (b & (c ^ d))
			k = 0x5A827999
			print("""
				----'^' means XOR-----
				with k = {}, f = d ^ (b & (c ^ d))
				f = {}
			""".format(
				hex(k), hex(f)
				))
		elif 20 <= i <= 39:
			f = (b ^ c ^ d)
			k = 0x6ED9EBA1
		elif 40 <= i <= 59:
			f = ((b & c) | (b & d) | (c & d))
			k = 0x8F1BBCDC
		elif 60 <= i <= 79:
			f = (b ^ c ^ d)
			k = 0xCA62C1D6
		
		temp = ((((a >> 27) | (a << 5)) & 0xffffffff) + f + e + k + _32b_words[i])& 0xffffffff 
		e = d
		d = c
		c = ((b << 30) | (b >> 2)) & 0xffffffff
		b = a
		a = temp

		print(""" 
			temp = (((({} >> 27) | ({} << 5)) & 0xffffffff) + {} + {} + {} + {})& 0xffffffff 
			e = {}
			d = {}
			c = (({} << 30) | ({} >> 2)) & 0xffffffff
			b = {}
			a = {}
			""".format(
				hex(a), hex(a), hex(f), hex(e), hex(k) , hex(_32b_words[i]),
				hex(d),
				hex(c),
				hex(b), hex(b),
				hex(a),
				hex(temp)
				))
		
		print("OUTPUT OF round {} hash: 0x{}".format(i+1, (hex(a)[2:].zfill(8)+hex(b)[2:].zfill(8)+hex(c)[2:].zfill(8)+hex(d)[2:].zfill(8)+hex(e)[2:].zfill(8))))
		input("")
		
	h0 = (h0 + a) & 0xffffffff
	h1 = (h1 + b) & 0xffffffff
	h2 = (h2 + c) & 0xffffffff
	h3 = (h3 + d) & 0xffffffff
	h4 = (h4 + e) & 0xffffffff
	

final_digest = 0
final_digest = ((h0 << 128) | (h1 << 96) | (h2 << 64) | (h3 << 32) | h4)
print(hex(final_digest))





