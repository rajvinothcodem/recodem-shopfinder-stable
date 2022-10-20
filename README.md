Recodem shopfinder module for adding and maintaining shop list

# Changelog

[1.0.1]
- 
- Extension for adding,editing and deleting shops in admin
- Available fields Shop Name, Shop Image, Unique identifier, Latitude and Longitude
- Created Graphql Api for getting the full shop list, get shop by identifier,
  update shop information and for delete api provided with error handling message as
  the shops cannot be deleted 
- To access the shop finder api create a admin token 

post : http://<host>/rest/<storecode>/V1/integration/admin/token

# Request 
{
  "username": "admin",
  "password": "admin123"
}
#Response
"eyJraWQiOiIxIiwiYWxnIjoiSFMyNTYifQ.eyJ1aWQiOjEsInV0eXBpZCI6MiwiaWF0IjoxNjY2MTg0MjA3LCJleHAiOjE2NjYxODc4MDd9.aAxPTz347WBjcddpL3zay05NhOto6wjPOa08HvTM-B4"


#Sample request for getting shop list
 {
  shopfinder {
    shop_id
    shop_name
    identifier
    shop_image
    latitude
  }
}
#Sample response shop list

    "data": {
        "shopfinder": [
            {
                "shop_id": 6,
                "shop_name": "Test r",
                "identifier": "store-1",
                "shop_image": "",
                "latitude": "0.0000000"
            },
            {
                "shop_id": 7,
                "shop_name": "Test",
                "identifier": "store-123",
                "shop_image": "",
                "latitude": "0.0000000"
            },
            {
                "shop_id": 14,
                "shop_name": "Test123",
                "identifier": "123-test",
                "shop_image": "",
                "latitude": "9.9000002"
            },
            {
                "shop_id": 15,
                "shop_name": "efer",
                "identifier": "new-2",
                "shop_image": "download_11.png",
                "latitude": "9.9000000"
            },
            {
                "shop_id": 16,
                "shop_name": "Testte",
                "identifier": "new-1",
                "shop_image": "download_11.png",
                "latitude": "9.9000000"
            },
            {
                "shop_id": 17,
                "shop_name": "Newshop",
                "identifier": "new-3",
                "shop_image": "download_11.png",
                "latitude": "9.9000005"
            }
        ]
    }


#Sample request for getting shop by identifier
 {
  shopsByIdentifier(identifier:"new-3") {
    shop_id
    shop_name
    identifier
    shop_image
    latitude
  }
}
#Sample response

    "data": {
        "shopsByIdentifier": {
            "shop_id": 17,
            "shop_name": "Newshop",
            "identifier": "new-3",
            "shop_image": "download_11.png",
            "latitude": "9.9000005"
        }
    }

#Sample request update shop information
mutation {
   updateshopinfo(
     input:{
         shop_id:17
        identifier:"new-3"
     }
   ){
        success_message
   }
 }
 
#Sample response

{
   "data": {
        "updateshopinfo": {
            "success_message": "Shop was updated"
        }
    }
}

#Sample request delete shop 
mutation {
   deleteshop(
     input:{
         shop_id:17
     }
   ){
        message
   }
 }
 
 #Sample response
 
     "errors": [
         {
             "message": "The shop Newshop cannot be deleted",
             "extensions": {
                 "category": "graphql-input"
             },
             "locations": [
                 {
                     "line": 2,
                     "column": 4
                 }
             ],
             "path": [
                 "deleteshop"
             ]
         }
     ],
     "data": {
         "deleteshop": null
     }
 
