You get an undirected graph with n nodes and weighted edges, where an edge’s weight is its repair cost, and every edge starts broken. You pick one budget, and every edge costing at most that budget gets repaired. Return the smallest budget that lets you travel from node 0 to node n − 1 using at most k edges, or −1 if none does. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Search the budget

1. W = sorted distinct costs. If even W's largest fails, return −1.
2. ok(M): BFS on edges with cost ≤ M; true when dist(n − 1) ≤ k.
3. Binary search W for the smallest M with ok(M).

Constructed checks (made-up values, run in code): n = 4, edges 0–1 (2), 1–2 (2), 2–3 (2), 0–3 (9), 1–3 (6) → 6 for k = 2, 9 for k = 1, 2 for k = 3; n = 3 with only edge 0–1 (4) → −1. Checked against trying every budget on 1,500 random graphs.

Ignoring the edge limit and taking the smallest bottleneck path: the first graph with k = 1 → 2 instead of 9.

Time: O((n + m) log m)  
Space: O(n + m)

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
