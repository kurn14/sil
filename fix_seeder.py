import re

with open('database/seeders/HeritageSiteSeeder.php', 'r') as f:
    content = f.read()

def repl(match):
    key = match.group(1)
    val = match.group(2)
    
    en_val = val
    if key == 'name':
        en_val = val.replace('Candi', 'Temple').replace('Keraton', 'Palace').replace('Masjid Gedhe', 'Grand Mosque').replace('Masjid', 'Mosque')
    
    return f"'{key}' => json_encode(['id' => '{val}', 'en' => '{en_val}']),"

content = re.sub(r"'(name|description|address)'\s*=>\s*'([^']+)',", repl, content)

with open('database/seeders/HeritageSiteSeeder.php', 'w') as f:
    f.write(content)
