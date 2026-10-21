## Two Kadane states

1. `keep = arr[0]`, `deleted = −∞`, `best = arr[0]`.
2. For each `x` after the first:
   - `deleted = max(deleted + x, keep)` (delete `x`, or an earlier one).
   - `keep = max(keep + x, x)`.
   - `best = max(best, keep, deleted)`.
3. Return `best`.

Update `deleted` with the old `keep`, before `keep` changes.

`[1,−2,0,3]` → 4 (delete −2). `[−1,−1,−1,−1]` → −1.

Do not allow an empty subarray; at least one element must remain, so the answer can be negative. Do not try every deletion with a fresh Kadane; that is O(n²).

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
