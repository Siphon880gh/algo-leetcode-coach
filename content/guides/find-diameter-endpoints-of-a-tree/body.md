You get an undirected tree with n nodes. A diameter is a longest simple path, and a tree can have several. Return a binary string where position i is 1 when node i is an endpoint of at least one diameter, and 0 otherwise. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Three BFS passes

1. BFS from 0; a = farthest node.
2. BFS from a: da, D = max da, b = farthest node. BFS from b: db.
3. s[v] = '1' if da[v] = D or db[v] = D.

Constructed checks (made-up trees, run in code): edges 0–1, 1–2, 1–3 → "1011"; a path 0–1–2–3–4 → "10001"; edges 0–1, 0–2, 0–3, 3–4, 3–5 → "011011". Checked against BFS from every node on 1,500 random trees.

Marking only a and b: the last tree → "010010" instead of "011011".

Time: O(n)  
Space: O(n)

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
