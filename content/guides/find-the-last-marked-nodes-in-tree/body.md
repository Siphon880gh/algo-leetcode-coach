In a tree, marking spreads each second from marked nodes to all their unmarked neighbours. For each node i, if only i is marked at time 0, return a node that is marked last. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Two endpoints

This assumes any node marked last is accepted when several tie.

1. BFS from 0 → farthest a; BFS from a → farthest b and da; BFS from b → db.
2. ans[i] = a if da[i] > db[i] else b.

Constructed check (run in code): edges 0–1, 1–2, 1–3, 3–4 → [4, 4, 4, 0, 0]. Checked against BFS from every node on 300 random trees.

Answering the node farthest from 0 for everyone: on that tree start 4 gets 4, itself.

Time: O(n)  
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
