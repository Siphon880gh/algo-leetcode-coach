## Largest first

`i = 0`, `j = n − 1`, `k = n − 1`. While `i ≤ j`:

- If `|nums[i]| > |nums[j]|`: `res[k] = nums[i]²`, `i += 1`.
- Else: `res[k] = nums[j]²`, `j −= 1`.
- `k −= 1`.

Return `res`.

Squares shrink toward the middle where the values are closest to 0, so the ends always hold the largest remaining square.

Do not square and sort; that works but is O(n log n). Do not fill from the front; the smallest square is somewhere in the middle.

Time: O(n)  
Space: O(n) for the result

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
