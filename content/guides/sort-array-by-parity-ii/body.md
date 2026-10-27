## Two pointers on two parities

`j = 1`. For `i` in `0, 2, 4, …`:

- If `nums[i]` is odd: while `nums[j]` is odd, `j += 2`. Swap `nums[i]` and `nums[j]`.

Return `nums`.

There are as many even numbers as even slots, so every odd value in an even slot has a matching even value in an odd slot. Both pointers only move forward.

Do not build two lists unless extra space is fine. Do not restart `j` at 1 for each `i`; that is O(n²).

Time: O(n)  
Space: O(1)

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
