## Subtract the too-small ones

`count(B)`: walk the array with `run = 0`. If `x ≤ B`, `run += 1`, else `run = 0`. Add `run` at every index; that counts the subarrays ending there with all elements `≤ B`.

The subarrays whose max is in `[left, right]` are those with max `≤ right`, minus those with max `≤ left − 1`. Return `count(right) − count(left − 1)`.

**One pass:** track `last_bad` (the last index with `x > right`) and `last_ok` (the last index with `x` in `[left, right]`). At each `i`, add `max(0, last_ok − last_bad)`.

Do not enumerate subarrays and track their max; that is O(n²). Do not forget that elements below `left` are allowed inside a subarray, as long as some element reaches `left`.

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
