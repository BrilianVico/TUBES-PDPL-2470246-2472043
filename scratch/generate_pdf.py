import subprocess
import os

html_path = r"c:\Users\vico\TUBES_PDPL_2472046_2472043\LAPORAN_PROGRES_MINGGU_5.html"
pdf_path = r"c:\Users\vico\TUBES_PDPL_2472046_2472043\LAPORAN_PROGRES_MINGGU_5.pdf"
chrome_path = r"C:\Program Files\Google\Chrome\Application\chrome.exe"

# Construct the file URL for Chrome
file_url = f"file:///{html_path.replace(os.sep, '/')}"

cmd = [
    chrome_path,
    "--headless=new",
    "--disable-gpu",
    f"--print-to-pdf={pdf_path}",
    file_url
]

print(f"Running command: {' '.join(cmd)}")
result = subprocess.run(cmd, capture_output=True, text=True)

print("Exit code:", result.returncode)
print("Stdout:", result.stdout)
print("Stderr:", result.stderr)

if os.path.exists(pdf_path):
    print("SUCCESS: PDF generated successfully!")
    print("Size:", os.path.getsize(pdf_path), "bytes")
else:
    print("FAILURE: PDF file was not created.")
