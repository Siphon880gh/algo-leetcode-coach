## Count pairs

1. s[0] = 0; s[i + 1] = s[i] + (a if nums[i] is odd else −b).
2. Compress the values of s.
3. For each R in order: add the number of earlier s[L] ≤ s[R], then insert s[R].

Examples → 7, 3, 0. Matched exact fractions on 2,000 random arrays. Prefix sums reach 10^14 and the count reaches about 5 · 10^9, so use 64-bit integers. n = 10^5 took 0.15 s in Python.

Counting only s[L] < s[R]: example 2 → 2 instead of 3. A ratio exactly equal to a / b is valid.

Time: O(n log n)  
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
