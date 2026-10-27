## Example first

1. toggle("B3"): a middle seat, cost 1.
2. toggle("A3"): a window next to the booked B3, cost 3.
3. getTotalTime() = 1 + 3 = 4.
4. getMinTime() = 2: book A3 first (1), then B3 (1).
5. After C3 (cost 1) and D3 (cost 3): total 8, minimum 4.

## Idea

1. A seat's cost is fixed when it is booked, so store it with the seat.
2. The total is the sum of stored costs for seats still booked.
3. For the minimum you may reorder: book each window before its middle neighbour and every seat costs 1. So the minimum is the number of booked seats.

## Steps

1. cost[row][seat] = 0 means free.
2. toggle: if the seat is booked, subtract its stored cost, decrement the count, and free it.
3. Otherwise its cost is 3 for A when B is booked or D when C is booked, else 1. Store it, add it to the total, increment the count.
4. getTotalTime returns the total; getMinTime returns the count.

## Trap

Recomputing costs from the current state. Book A2 and then B2: A2 cost 1 when it was booked, so the total is 2, but recomputing sees A2 next to a booked B2 and gives 4. Fix: store the cost at booking time.

Checked: both example call sequences match, and getMinTime matched trying every booking order on 300 random call sequences.

Time: O(1) per call  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
