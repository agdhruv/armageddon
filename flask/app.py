#!bin/python
from flask import Flask
import os
import functions
import filecmp
app = Flask(__name__)

@app.route('/judge/<submission_id>/<problem_id>/<int:timeout>/<language_id>', methods=['GET']) # time limit = timeout
def index(submission_id, problem_id, timeout,language_id):
    submission_path = "../submissions/" + str(submission_id) + "." + language_id
    problem_path = "../problems/" + str(problem_id) + "/"
    if language_id=="py":
        verdict = functions.judge(submission_path, problem_path, timeout, language_id)
        return verdict
    elif language_id=="cpp":
        r = os.system("timeout " + str(timeout) + " g++ -o " + "binaries/" + submission_id + " " + submission_path + " -std=c++14 -DONLINE_JUDGE")
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
    elif language_id=="java":
        os.system("mv " + submission_path + " submissions/Main.java")
        r = os.system("timeout " + str(timeout) + " javac submissions/Main.java")
        k = "ERROR JAVA-511: Please report this issue"
        if r!=0:
            k = "CE"
        else:
            r = os.system("timeout " + str(timeout) + " java -cp submissions/ Main < " + input_path + " > " + output_path)
            if r==31744:
                k = "TLE"
            elif r!=0:
                k = "RTE"
            elif filecmp.cmp(output_path,exoutput_path):
                k = "AC"
            else:
                k = "WA"
            r = os.system("mv submissions/Main.java " + submission_path)
            os.system("rm submissions/Main.class")
        return k
if __name__ =='__main__':
    app.run(debug=True)
