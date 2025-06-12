import qrcode 
import socket

# Get the local IP address
hostname = socket.gethostname()
ip_address = socket.gethostbyname(hostname)

# Create the complaint links dictionary
urls = {
    "hostel": f"http://10.10.26.220:5500/hostel_form.html",
    "library": f"http://{ip_address}/library_form.html",
    "canteen": f"http://{ip_address}/canteen_form.html",
    "academics": f"http://{ip_address}/academics_form.html"
}


# Loop through the URLs and generate QR codes
for name, url in urls.items():
    qr = qrcode.QRCode(
        version=1,
        error_correction=qrcode.constants.ERROR_CORRECT_L,
        box_size=10,
        border=4,
    )
    qr.add_data(url)
    qr.make(fit=True)
    
    img = qr.make_image(fill="black", back_color="white")
    img.save(f"{name}_qr.png")
    print(f"QR Code saved as {name}_qr.png")