## One pointer

1. order = indices sorted by (nums[i], i); s = Σ nums; p = 0.
2. Query (idx, k): if idx unmarked, mark it and s −= nums[idx]. While k > 0 and p < n: i = order[p++]; if unmarked, mark, s −= nums[i], k −= 1.
3. Record s.

Examples → [8, 3, 0], [7].

Skipped (already marked) elements must not use up k: counting them gives example 1 → [8, 5, 0]. The pointer moves at most n times in total.

Time: O(n log n + m)  
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
