You get a circular array balance, where balance[i] is person i's net balance (negative means a shortfall). In one move a person hands exactly 1 unit to the neighbour on either side, and the first and last people are neighbours. Return the fewest moves that leave every balance at least 0, or −1 if that is impossible. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Min-cost flow

1. Sum of balances < 0 → −1.
2. Source → i with capacity balance[i] for each surplus; i → sink with capacity −balance[i] for each deficit; i → i ± 1 (around the circle) with unlimited capacity and cost 1.
3. Push the total deficit with successive shortest paths and return the cost.

Assumed here: n is at most about 1000. Each augmentation saturates a source or sink edge or reroutes a whole edge, so there are O(n) augmentations.

Constructed checks (made-up values, run in code): [3, −1, −1, −1] → 4; [−2, 0, 5, −2, −1] → 8; [1, −2, 0] → −1. Matched breadth-first search over single moves on random arrays with n ≤ 5. A random n = 1000 case ran in 1.5 s in Python.

Passing units in one direction only: the first check → 6 instead of 4.

Time: O(n²) in practice (O(n³) worst case with SPFA, O(n² log n) with Dijkstra and potentials)  
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
