## Next pointers

1. nxt[i] = i + 1, count = n − 1.
2. For u → v: if u is live and nxt[u] < v, delete every city from nxt[u] up to v (count −= 1 each) and set nxt[u] = v.
3. Record count.

Examples → [3, 2, 1], [1, 1]. Checked against BFS on 300 random non-crossing query lists.

BFS per query is about 10^5 · 10^5 = 10^10 steps.

Time: O(n + q), each city deleted once  
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
