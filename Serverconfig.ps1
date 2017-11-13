#variable declaration
$cred = Get-Credential
$dir = "$env:USERPROFILE\Desktop\servers"
$computer = Get-Content "$dir\servers.txt"
$isvm = ""

foreach($c in $computer){

if(Test-Connection $c -Count 1 -Quiet){
Write-Host "Gathering data for $c..."
#device
$model = gwmi win32_computersystem -computername $c -Credential $cred | select-object -ExpandProperty Model
$manufacturer = gwmi win32_computersystem -computername $c -Credential $cred | select-object -ExpandProperty Manufacturer 
if ($manufacturer -like "*VM*"){$isvm = "Yes"}
    else{$isvm = "No"}
#Operating system
$osname = gwmi win32_operatingsystem -ComputerName $c -Credential $cred | Select-Object -ExpandProperty Caption
#Installdate
$installdate = ([WMI] '').ConvertToDateTime((Get-WmiObject Win32_OperatingSystem -ComputerName $c -Credential $cred).InstallDate)
$architecture = gwmi win32_operatingsystem -ComputerName $c -Credential $cred | Select-Object -ExpandProperty OSArchitecture
#CPU
$cpu = gwmi win32_processor -ComputerName $c -Credential $cred
$cpuname = $cpu.Name
$cpudescr = $cpu.Description
$cpuspeed = $cpu.MaxClockSpeed
$cpucores = $cpu.NumberOfCores
#RAM
$RAM = gwmi win32_computersystem -ComputerName $c -Credential $cred | Select-Object -ExpandProperty TotalPhysicalMemory
$ramMB = [math]::round($RAM/1024/1024, 0)
#BIOS serial
$serial = gwmi win32_bios -ComputerName $c -credential $cred | Select-Object -ExpandProperty SerialNumber
#Network
$network = gwmi win32_networkadapterconfiguration -Filter 'ipenabled = "true"' -ComputerName $c -Credential $cred
$NICdescr = $network.Description
$ip = $network.IPAddress[0]
$subnet = $network.IPSubnet[0]
$gw = $network.DefaultIPGateway[0]
$DNS = $network.DNSServerSearchOrder

$output = 
"<!-- Gather the rest of the information from script -->
<!-- Machine details -->
<!-- Is it a VM: Yes or No -->
{{#vardefine:isvm
|$isvm
}}
<!-- Server model -->
{{#vardefine:model
|$model
}}
<!-- Server Manufacturer -->
{{#vardefine:manufacturer
|$manufacturer
}}
<!-- Operating System -->
{{#vardefine:os
|$osname
}}
<!-- Install date -->
{{#vardefine:installed
|$installdate
}}
<!-- Architecture -->
{{#vardefine:architecture
|$architecture
}}
<!-- Processor name -->
{{#vardefine:cpu
|$cpuname
}}
<!-- Processor description -->
{{#vardefine:cpu descr
|$cpudescr
}}
<!-- CPU speed -->
{{#vardefine:cpu speed
|$cpuspeed MHz
}}
<!-- CPU amount -->
{{#vardefine:cpu amount
|$cpucores
}}
<!-- RAM amount -->
{{#vardefine:ram
|$ramMB MB
}}
<!-- Serial number -->
{{#vardefine:serial
|$serial
}}
<!-- NIC description -->
{{#vardefine:NICdescr
|$NICdescr
}}
<!-- IP address -->
{{#vardefine:ip
|$IP
}}
<!-- Subnet -->
{{#vardefine:subnet
|$subnet
}}
<!-- Gateway -->
{{#vardefine:gw
|$gw
}}
<!-- DNS -->
{{#vardefine:dns
|$DNS
}}
<!-- Domain name -->
{{#vardefine:domain
|[[rhenus.int]]
}}"
$output | Out-File "$env:USERPROFILE\Desktop\servers\$c.txt"
Write-Host "Done."
}
else {
    Write-Host "$c is unavailable, try again later"}
}
Invoke-Item $dir
