## Layer by edge count

1. cur[v] = {0} for every v (a path with 0 edges).
2. Repeat k times: nxt[v] = {s + w : edge u → v of weight w, s in cur[u], s + w < t}; cur = nxt.
3. Answer the largest value in any cur[v], or −1.

Examples → 3, 2, −1. Checked against listing every path on 300 random DAGs.

Keeping only the largest sum per node and edge count: n = 4, edges [[0, 2, 7], [1, 2, 10], [2, 3, 3]], k = 2, t = 12 → −1 instead of 10.

Time: O(k · E · t)  
Space: O(n · t)

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
