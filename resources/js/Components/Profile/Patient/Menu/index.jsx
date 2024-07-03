import React from "react";
import styles from "./style.module.css";

const Menu = ({ tabs, activeTab, changeTab }) => {
  return (
    <div className={`${styles.container} w-full md:w-4/12 `}>
      <div className={styles.menu}>
        {tabs.map((item) => (
          <button
            onClick={() => changeTab(item.id)}
            to={item.path}
            key={item.id}
            className={[
              styles.menuItem,
              item.id == activeTab ? styles.active : null,
            ].join(" ")}
          >
            {item.label}
          </button>
        ))}
      </div>
    </div>
  );
};

export default Menu;
