## Alternate rises and falls

`inc = dec = 1`, `best = 1`. For `i` from 1:

- `arr[i] > arr[i − 1]`: `inc = dec + 1`, `dec = 1`.
- `arr[i] < arr[i − 1]`: `dec = inc + 1`, `inc = 1`.
- Equal: `inc = dec = 1`.
- `best = max(best, inc, dec)`.

Return `best`.

Use the old values on the right side of each update (update both at once).

A sliding window with a comparison sign also works: reset the start whenever two signs in a row match or a sign is 0.

Do not count only rises or only falls. Do not treat equal neighbors as a sign change.

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
