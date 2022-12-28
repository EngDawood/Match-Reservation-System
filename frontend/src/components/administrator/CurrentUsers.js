import React, { useContext, useEffect } from "react";
import UserCard from "./UserCard";
import { AlertContext } from "../../contexts/AlertContext";
import { handelDeleteUser, getCurrentUsers } from "./Service";

import CustomLoading from "../loading/CustomLoading";
const CurrentUsers = () => {
  const alertContext = useContext(AlertContext);
  let [users, setUsers] = React.useState([]);
  const [userLoading, setUserLoading] = React.useState(true);

  useEffect(() => {
    getCurrentUsers(setUsers, setUserLoading);
  }, []);

  const handleNo = (user) => {
    handelDeleteUser(user, alertContext, setUsers, users);
  };

  return (
    <div>
      <h1 className="mb-5 text-left">Current Users</h1>

      <div className="row mt-2">
        {userLoading && <CustomLoading />}

        {users.map((user) => {
          return (
            <div className="col-12 col-md-6 col-lg-4 mb-2">
              <UserCard
                name={user.name}
                username={user.username}
                city={user.city}
                email={user.email}
                gender={user.gender}
                role={user.role}
                birthday={user.birthday}
                type="current"
                handleNo={handleNo.bind(this, user)}
              />
            </div>
          );
        })}
      </div>
    </div>
  );
};

export default CurrentUsers;
