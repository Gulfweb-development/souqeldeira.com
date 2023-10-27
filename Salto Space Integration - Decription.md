Hoai,

Now it's time to add another lock system to our system. This time it's another system from 
Salto named Salto Space.

Salto Space is a server based lock system, running on a physical server in the actual 
building where the locks are installed. Besides that it is very much the same as the Salto KS 
system that we already have an integration with. In the Salto Space world the API/protocol is 
called SHIP (Salto-Host Interface Protocol). We will have to add almost the same kind of 
information to a booking object in our system. As you can see some extra variables are 
added:



- API credentials ("Salto-SHIP-Key" = a uniqe credential to be able to talk to the Salto Space 
server)
- Site ID ("Salto Space URL" = a url/IP address and optional port to the server)
- Lock ID ("ExtDoorID" = Unique ID for each lock in the system)
- GPF to use [GPF1...GPF5] (A droplist with the alternatives GPF1, GPF2, GPF3, GPF4 and 
GPF5 to choose from. This is new for the Salto Space solution. See more info below)
- Booking name prefix (Text input. Default text: "Booking-". See more info below)
- Booking description syntax (Text input. Default text: "Booking of [booking objects] for 
apartment [user aliases]". See more info below)

---

We have access to a Salto Space server that we can use for the integration development 
and testing. The server include a Web Portal where we can log in and see the Site, the 
Locks, Access Groups, Users, etc. The Web Portal and the API are connected so if you 
change anything in the API you can immediately see the changes in the Web Portal. That 
makes the development very easy.

Web Portal is possible to access using the following url and credentials:
[http://95.143.205.105:8100](http://95.143.205.105:8100 "")
Username: henrik
Password: Chewer-Fretful3-

---

There will be two user lists, one in Salto Space and one in Boka Tv�ttid. Salto Space can 
have many users in each apartment. To map the Boka Tv�ttid users (apartment numbers) to 
the Salto Space users (ExtUserID) we would like to do like this:

All Salto Space users (<SaltoDBUser>) include a lot of information about the user. Among all 
information they also have 5 GPF-tags (General Purpose Field). These are fields where we 
can store any information we like about a user. In our case we will use one of these fields to 
store the Boka user ID (Aoartment ID/User ID). When we specify API creddntials, Site ID, 
Lock ID for a booking object we also specify the GPF number (1, 2, 3, 4 or 5). If we choose 
for example GPF1 we will then make sure that each user has a valid Apartment ID/User ID 
in the GPF1 field in the user XML returned from Salto Space. See below:

Request to Salto Space API to get all users:
[http://95.143.205.105:8100?Content-Type=application/vnd.saltosystems.ship.v1+xml&Salto-SHIP-Key=Chewer-Fretful3-](http://95.143.205.105:8100?Content-Type=application/vnd.saltosystems.ship.v1+xml&Salto-SHIP-Key=123456 "")

```xml
<?xml version="1.0" encoding="UTF-8"?>
<RequestCall>
    <RequestName>SaltoDBUserList.Read</RequestName>
    <Params>
        <MaxCount>5</MaxCount>
    </Params>
</RequestCall>
```

Response from the Salto Space server:

```xml
<?xml version='1.0' encoding='utf-8'?>
<RequestResponse>
    <RequestName>SaltoDBUserList.Read</RequestName>
    <Params>
        <SaltoDBUserList>
            <SaltoDBUser>
                <ExtUserID>05D089B5361E10CC610008DBBE7B41B9</ExtUserID>
                <ExtPartitionID>F3151A87832B44DBA19317A123BBBB66</ExtPartitionID>
                <Title/>
                <FirstName>Thomas</FirstName>
                <LastName>Ravelli</LastName>
                <Office>0</Office>
                <AuditOpenings>0</AuditOpenings>
                <UseADA>0</UseADA>
                <UseAntipassback>0</UseAntipassback>
                <CalendarID>1</CalendarID>
                <UseLockCalendar>1</UseLockCalendar>
                <GPF1>1203</GPF1>
                <GPF2/>
                <GPF3/>
                <GPF4/>
                <GPF5/>
                <AutoKeyEdit.ROMCode/>
                <CurrentROMCode>04E53F5ACB5280</CurrentROMCode>
                <UserActivation>2023-09-26T10:25:00</UserActivation>
                <UserExpiration.Enabled>0</UserExpiration.Enabled>
                <UserExpiration>2000-01-01T00:00:00</UserExpiration>
                
<KeyExpirationDifferentFromUserExpiration>1</KeyExpirationDifferentFromUserExpiration>
                <KeyRevalidation.UpdatePeriod>30</KeyRevalidation.UpdatePeriod>
                <KeyRevalidation.UnitOfUpdatePeriod>0</KeyRevalidation.UnitOfUpdatePeriod>
                <CurrentKeyExists>1</CurrentKeyExists>
                <CurrentKeyPeriod>
                    <StartDate>2000-01-01T00:00:00</StartDate>
                    <EndDate>2023-10-29T24:00:00</EndDate>
                </CurrentKeyPeriod>
                <CurrentKeyStatus>1</CurrentKeyStatus>
                <PINEnabled>0</PINEnabled>
                <PINCode/>
                <WiegandCode/>
                <IsBanned>0</IsBanned>
                <KeyIsCancellableThroughBlacklist>1</KeyIsCancellableThroughBlacklist>
                <LockdownEnabled>0</LockdownEnabled>
                <OverrideLockdown>0</OverrideLockdown>
                <OverridePrivacy>0</OverridePrivacy>
                <LocationFunctionTimezoneTableID>0</LocationFunctionTimezoneTableID>
                <PhoneNumber/>
                <MobileAppType>0</MobileAppType>
                <ExtLimitedEntryGroupID/>
                <PictureFileName/>
                <AuthorizationCodeList/>
            </SaltoDBUser>
            <SaltoDBUser>
                <ExtUserID>31898E390C6F9FCB288008DBBE7B653F</ExtUserID>
                <ExtPartitionID>F3151A87832B44DBA19317A123BBBB66</ExtPartitionID>
                <Title/>
                <FirstName>Patrik</FirstName>
                <LastName>Andersson</LastName>
                <Office>0</Office>
                <AuditOpenings>0</AuditOpenings>
                <UseADA>0</UseADA>
            </SaltoDBUser>
        </SaltoDBUserList>
    </Params>
</RequestResponse>
```

Unfortunatly we can't ask Salto Space for a list of all users with the GPF1 tag set to "1". So 
we will have to fetch the complete list of users every time, parse the XML and find all 
matching users with a GPF1 set to "1203" (or the Apartment number we are interested in). 
When need to find all users to be able to get their unique <ExtUserID> which is the identifier 
for a user in Salto Space. We need this to be able to create a "booking" in Salto Space.

---

When we have the ExtUserID for the user/users that should do the booking we can create a 
"booking" in Salto Space by creating a "User access level". This is done in the following way:

Request to Salto Space API to create a "User access level":
[http://95.143.205.105:8100?Content-Type=application/vnd.saltosystems.ship.v1+xml&Salto-SHIP-Key=Chewer-Fretful3-](http://95.143.205.105:8100?Content-Type=application/vnd.saltosystems.ship.v1+xml&Salto-SHIP-Key=123456 "")

```
<?xml version="1.0" encoding="UTF-8"?>
<RequestCall>
    <RequestName>SaltoDBGroup.Insert</RequestName>
    <Params>
        <SaltoDBGroup>
            <ExtGroupID>VS102</ExtGroupID>
            <Name>Booking-102</Name>
            <Description>Booking of Tv�ttstugan for apartment 1203</Description>
            <SaltoDB.AccessPermissionList.Group_Door>
                <SaltoDB.AccessPermission.Group_Door>
                    <ExtDoorID>4597BBA325A95DC1228008DBBE7BA912</ExtDoorID>
                    <UsePeriod>1</UsePeriod>
                    <Period>
                        <StartDate>2023-10-05T10:00:00</StartDate>
                        <EndDate>2023-10-05T14:00:00</EndDate>
                    </Period>
                </SaltoDB.AccessPermission.Group_Door>
            </SaltoDB.AccessPermissionList.Group_Door>
            <SaltoDB.MembershipList.User_Group>
                <SaltoDB.Membership.User_Group>
                    <ExtUserID>05D089B5361E10CC610008DBBE7B41B9</ExtUserID>
                </SaltoDB.Membership.User_Group>
            </SaltoDB.MembershipList.User_Group>
        </SaltoDBGroup>
    </Params>
</RequestCall>
```

Response from the Salto Space server:

```
<?xml version='1.0' encoding='utf-8'?>
<RequestResponse>
    <RequestName>SaltoDBGroup.Insert</RequestName>
    <Params>
        <ExtGroupID>G102</ExtGroupID>
    </Params>
</RequestResponse>
```

As you can see the XML include:

- one or many users
- one or many doors
- a time period (start access time and stop access time)

When we receive a valid response with an <ExtGroupID> (a unique ID for that booking) the 
booking is done!

---

If a user unbook we simply remove the booking by using the ExtGroupID for that booking:

Request to Salto Space API to remove a "User access level"/booking:
[http://95.143.205.105:8100?Content-Type=application/vnd.saltosystems.ship.v1+xml&Salto-SHIP-Key=Chewer-Fretful3-](http://95.143.205.105:8100?Content-Type=application/vnd.saltosystems.ship.v1+xml&Salto-SHIP-Key=123456 "")

```
<?xml version="1.0" encoding="UTF-8"?>
<RequestCall>
    <RequestName>SaltoDBGroup.Delete</RequestName>
    <Params>
        <ExtGroupID>G102</ExtGroupID>
    </Params>
</RequestCall>
```

Response from the Salto Space server:

```
<?xml version='1.0' encoding='utf-8'?>
<RequestResponse>
    <RequestName>SaltoDBGroup.Delete</RequestName>
    <Params>
        <ExtGroupID>G102</ExtGroupID>
    </Params>
</RequestResponse>
```

---

Below I would like to explain the values in the booking request sent to Salto Space:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<RequestCall>
    <RequestName>SaltoDBGroup.Insert</RequestName>
    <Params>
        <SaltoDBGroup>
            <ExtGroupID>VS102</ExtGroupID>
            <Name>Booking-102</Name>
            <Description>Booking of Tv�ttstugan for apartment 1203</Description>
            <SaltoDB.AccessPermissionList.Group_Door>
                <SaltoDB.AccessPermission.Group_Door>
                    <ExtDoorID>4597BBA325A95DC1228008DBBE7BA912</ExtDoorID>
                    <UsePeriod>1</UsePeriod>
                    <Period>
                        <StartDate>2023-10-05T10:00:00</StartDate>
                        <EndDate>2023-10-05T14:00:00</EndDate>
                    </Period>
                </SaltoDB.AccessPermission.Group_Door>
            </SaltoDB.AccessPermissionList.Group_Door>
            <SaltoDB.MembershipList.User_Group>
                <SaltoDB.Membership.User_Group>
                    <ExtUserID>05D089B5361E10CC610008DBBE7B41B9</ExtUserID>
                </SaltoDB.Membership.User_Group>
            </SaltoDB.MembershipList.User_Group>
        </SaltoDBGroup>
    </Params>
</RequestCall>
```

`<ExtGroupID>VS102</ExtGroupID>`
"VS" is short for Visir Solutions and is a fixed value.
"102" is a unique number for this booking. We choose this number ourselves but it must be 
unique.

`<Name>Booking-102</Name>`
"Booking-" is specified by the boka admin when adding the Salto Space lock to a booking 
object (Booking name prefix).
"102" same as above in <ExtGroupID>.

`<Description>Booking of Tv�ttstugan for apartment 1203</Description>`
This is a short description that is visible in the Salto Space web GUI. The booking 
description syntax should be specified by the boka admin when adding the Salto Space lock.

The description has some free text and two fixed values:
`<Description>Booking of {a comma separated list of all booking objects added to this 
booking} for apartment {the alias for the apartment added to this booking}</Description>`

Examples (Booking description syntax: "Booking of [booking objects] for apartment [user 
alias]"):
`<Description>Booking of Tv�ttstugan for apartment 1203</Description>`
`<Description>Booking of Laundryroom #1, Laundryroom #2, Drying room for apartment 123</Description>`

Examples (Booking description syntax: "This is a booking of [booking objects] done by [user 
alias]"):
`<Description>This is a booking of Tv�ttstugan done by 1203</Description>`
`<Description>This is a booking of Laundryroom #1, Laundryroom #2, Drying room done by 123</Description>`
---

I'm sure I have missed some details. Please ask me about anything Hoai!

