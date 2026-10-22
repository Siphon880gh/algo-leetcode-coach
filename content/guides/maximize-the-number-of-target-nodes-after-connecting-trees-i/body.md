## Two independent counts

1. c1[i] = nodes within k of i in tree 1 (BFS from each node).
2. best = max over j of nodes within k − 1 of j in tree 2 (0 if k = 0).
3. answer[i] = c1[i] + best.

Examples → [9, 7, 9, 8, 8], [6, 3, 3, 3, 3]. Checked against trying every connecting edge on 60 random tree pairs.

Using distance k in tree 2 too: example 1 → [12, 10, 12, 11, 11].

Time: O(n² + m²), at most about 2 · 10^6  
Space: O(n + m)

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
