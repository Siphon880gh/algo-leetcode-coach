## Four states per node

1. Leaf v: [first, last both free] = 0, [both taken] = v, the mixed states impossible.
2. Merge: res[a][b] = max(L[a][0] + R[0][b], L[a][0] + R[1][b], L[a][1] + R[0][b]).
3. After each update, add max over the root’s states (the empty choice gives 0). Return the total mod 10^9 + 7.

Examples → 21, 0. Checked against an O(n) DP after every query on 500 random cases.

Rerunning the O(n) DP per query is 2.5 · 10^9 steps at 5 · 10^4 each.

Time: O((n + q) log n)  
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
