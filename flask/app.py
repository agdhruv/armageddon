#!bin/python
from flask import Flask
import os
import filecmp
app = Flask(__name__)

@app.route('/judge/<submission_id>/<input_id>/<exoutput_id>/<int:timeout>/<language_id>', methods=['GET']) # time limit = timeout
def index(submission_id, input_id, exoutput_id,timeout,language_id):
    submission_path = "submissions/" + str(submission_id) + "." + language_id
    input_path = "inputs/" + str(input_id) + ".txt"
    print(input_path)
    exoutput_path = "exoutputs/" + str(exoutput_id) + ".txt"
    output_path = "outputs/" + str(submission_id) + ".txt"
    r = -1
    if language_id=="py":
        r = os.system("timeout " + str(timeout) + " python3 " + submission_path + " < " + input_path + " > " + output_path) 
        if r==31744: # the error code returned when timeout times out. Haha
            return "TLE"
        elif r!=0:
            return "CE"
        elif filecmp.cmp(output_path,exoutput_path):
            return "AC"
        else:
            return "WA"              
    elif language_id=="cpp":
        r = os.system("timeout " + str(timeout) + " g++ -o " + "binaries/" + submission_id + " " + submission_path)
        if r!=0:
            return "CE"
        r = os.system("timeout " + str(timeout) + " ./" + "binaries/" + submission_id + " < " + input_path + " > " + output_path)
        if r==31744:
            return "TLE"
        elif r!=0:
            return "RTE"
        elif filecmp.cmp(output_path,exoutput_path):
            return "AC"
        else:
            return "WA"
    elif language_id=="c":
        r = os.system("timeout " + str(timeout) + " gcc -o " + "binaries/" + submission_id + " " + submission_path)
        if r!=0:
            return "CE"
        r = os.system("timeout " + str(timeout) + " ./" + "binaries/" + submission_id + " < " + input_path + " > " + output_path)
        if r==31744:
            return "TLE"
        elif r!=0:
            return "RTE"
        elif filecmp.cmp(output_path,exoutput_path):
            return "AC"
        else:
            return "WA"
if __name__ =='__main__':
    app.run(debug=True)
