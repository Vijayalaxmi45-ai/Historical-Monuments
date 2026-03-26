import os
import re

cur_dir = r"c:\All-Projects\My_Project"

forts = [
    "Charminar.html",
    "Harishchandragad.html",
    "Murud_Janjira.html",
    "Pratapgad.html",
    "Raigad.html",
    "Rajgad.html",
    "Red_fort.html",
    "Sinhagad.html",
    "Torana.html",
    "ajanta.html",
    "amer_fort.html",
    "chitrogarh_fort.html",
    "gateway.html",
    "hampi.html",
    "hava_mahal.html",
    "jagannath_temple.html",
    "rani_ki_vav.html",
    "sun_temple.html",
    "victoria.html"
]

css_to_add = """
.back-container {
    width: 100%;
    max-width: 850px;
    margin: 0 auto;
    text-align: left;
    margin-bottom: 20px;
}
.back-btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #FFD700;
    color: #000;
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}
.back-btn:hover {
    background-color: #e6c200;
}
"""

style_path = os.path.join(cur_dir, "style.css")
with open(style_path, "r", encoding="utf-8") as f:
    css_content = f.read()

if ".back-btn" not in css_content:
    with open(style_path, "a", encoding="utf-8") as f:
        f.write(css_to_add)

btn_html = '    <div class="back-container">\n        <a href="FortInfo.html" class="back-btn">&larr; Back</a>\n    </div>\n'

for fort in forts:
    filepath = os.path.join(cur_dir, fort)
    if os.path.exists(filepath):
        with open(filepath, "r", encoding="utf-8") as f:
            content = f.read()
        
        if '<div class="back-container">' not in content:
            # Inject before <h1>
            content = re.sub(r'(<h1.*?>)', btn_html + r'\1', content, count=1, flags=re.IGNORECASE)
            with open(filepath, "w", encoding="utf-8") as f:
                f.write(content)
            print(f"Added back button to {fort}")
        else:
            print(f"Back button already exists in {fort}")
    else:
        print(f"File not found: {fort}")

