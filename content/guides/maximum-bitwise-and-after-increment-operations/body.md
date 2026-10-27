## Greedy bits

1. ans = 0. For bit from high to low: t = ans | (1 << bit).
2. For each x: j = bit length of (t AND NOT x); low = 2^j − 1; cost = (t AND low) − (x AND low).
3. Sort costs; if the m smallest sum to ≤ k, ans = t.
4. Return ans.

Examples → 6, 4, 2. Checked against trying every subset and increment split on 400 small cases.

Treating a number already above t as free: example 2 → 6 instead of 4.

Time: O(B · n log n), B = bits of max(nums) + k  
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
