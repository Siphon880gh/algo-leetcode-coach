## Two precomputed bounds

1. `suf[i]` = min of `nums[i …]`.
2. Scan `i` from 1 to `n − 2` with `pre` = max of `nums[0 … i − 1]`:
   - `pre < nums[i] < suf[i + 1]` → +2;
   - else `nums[i − 1] < nums[i] < nums[i + 1]` → +1.
3. Update `pre`.

Examples → 2, 1, 0. Checked against the direct definition on random arrays.

The 2-condition already implies the 1-condition, so test it first. Comparisons are strict.

Time: O(n)  
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
