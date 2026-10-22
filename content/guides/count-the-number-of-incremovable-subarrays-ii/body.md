## Two pointers

1. i = last index of the increasing prefix. If i = n − 1, return n(n + 1) / 2.
2. ans = i + 2 (remove from l to the end, l = 0 … i + 1).
3. For j = n − 1 down while nums[j … n − 1] is strictly increasing: while i ≥ 0 and nums[i] ≥ nums[j], i −= 1; ans += i + 2.

Examples → 10, 7, 3. Checked against part I’s brute force on 2,000 random arrays.

i only moves left as j moves left, so the whole scan is linear. The count reaches about 5 · 10^9; use 64-bit.

Time: O(n)  
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
