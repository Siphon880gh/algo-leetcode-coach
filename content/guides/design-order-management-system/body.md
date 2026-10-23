Design an order book for a trading platform. Each order has a unique id, a type (buy or sell) and a price, and it stays active until canceled. Support adding an order, changing an active order’s price, canceling an active order, and listing the ids of all active orders with a given type and price, in any order. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Id map plus bucket map

1. addOrder: info[id] = (type, price); bucket[(type, price)].add(id).
2. modifyOrder: remove id from its old bucket, update info, add to the new bucket.
3. cancelOrder: remove id from its bucket and from info.
4. getOrdersAtPrice: return the ids in bucket[(type, price)].

Constructed check (made-up calls, run in code): add 10 sell 50, 11 sell 50, 12 buy 50; list sell 50 → [10, 11]; modify 10 to 60; list sell 50 → [11], sell 60 → [10]; cancel 11; list sell 50 → [], buy 50 → [12].

Leaving the id in its old bucket on modify: the second list → [10, 11] instead of [11].

Time: O(1) per update, O(r) to list r ids  
Space: O(orders)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
