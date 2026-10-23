## All windows

1. For each l, for r = l … n − 1: g = gcd(g, nums[r]); e = trailing zero bits of nums[r]; track the minimum e and how many elements have it.
2. Score = (r − l + 1) · g · (2 if count ≤ k else 1).
3. Answer the maximum score.

Examples → 8, 14, 15. Checked against trying every choice of doubled elements on 300 random arrays.

Always doubling the gcd when k ≥ 1: example 3 → 30 instead of 15.

Time: O(n² log max)  
Space: O(1)

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
