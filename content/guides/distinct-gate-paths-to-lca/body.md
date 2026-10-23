You get a tree rooted at node 0 as a parent array. Every node has some red, blue, and white gates. A person holding a red or blue card moves from a node to its parent by using one gate at that node: a gate of the card's colour keeps the card, and a white gate flips it. Each query gives Alice's start node and card and Bob's start node and card; both climb to their lowest common ancestor. Count the ways for each query (Alice's ways times Bob's, modulo 10^9 + 7, where every gate is distinct) and return the XOR of all the counts. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Lift matrices

1. M[v] = [[blue, white], [white, red]] (rows: card held at v, columns: card after the gate).
2. up[0][v] = parent, P[0][v] = M[v]; P[j][v] = P[j − 1][v] · P[j − 1][up[j − 1][v]], mod 10^9 + 7.
3. Per query: l = LCA(a, b). Start with the unit row for the card, multiply by the lifted products while climbing to l, and sum the row. A person already at l has 1 way.
4. XOR (ways(a) · ways(b) mod 10^9 + 7) over all queries.

Assumed here: card 1 is red and 0 is blue, the card at the LCA can be either colour, and a node with no usable gate gives 0 ways.

Constructed checks (made-up values, run in code): parent = [−1, 0, 1, 2], gates = [[0, 0, 0], [1, 0, 2], [0, 2, 1], [3, 1, 0]], queries = [[3, 1, 0, 0], [3, 0, 1, 1]] → 5; a five-node tree → 11. Checked against recursive counting on 1,500 random trees.

Letting a white gate keep the card: the first check → 10 instead of 5.

Time: O((n + q) log n)  
Space: O(n log n)

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
