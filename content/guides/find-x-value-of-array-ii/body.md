## Node merge

1. Node: prod, cnt[0 … k − 1].
2. Merge: prod = L.prod · R.prod; cnt = L.cnt plus, for each r, R.cnt[r] added at (L.prod · r) mod k.
3. Query: update nums[index], combine nodes covering [start, n − 1] left to right, return cnt[x].

Examples → [2, 2, 2], [1, 0]. Checked against direct counting on 300 random cases.

Not keeping earlier updates: example 1 → [2, 2, 1] instead of [2, 2, 2].

Time: O((n + q) · k · log n)  
Space: O(n · k)

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
