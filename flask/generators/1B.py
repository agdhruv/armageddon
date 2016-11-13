import random
import string
t = 1#000
def randomword(length):
	return ''.join(random.choice(string.ascii_uppercase + string.ascii_lowercase + string.digits) for _ in range(length))
for i in range(0,10#00):
    k = randomword(10)
	print(k)
