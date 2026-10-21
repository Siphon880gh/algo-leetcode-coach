## Extend, start, or fail

`cnt[v]` = how many copies of `v` are still unused; `end[v]` = how many finished runs (length ≥ 3) end at `v`.

For each `x` in `nums` (sorted order):

1. If `cnt[x] == 0`, it was already used: skip.
2. `cnt[x] −= 1`.
3. If `end[x − 1] > 0`: move one run from ending at `x − 1` to ending at `x`.
4. Else if `cnt[x + 1] > 0` and `cnt[x + 2] > 0`: use both and record `end[x + 2] += 1`.
5. Else return false.

Return true at the end. Extending first is safe: a new run would need two more values that could otherwise extend other runs, and extending never hurts.

Do not start a new run when an existing one can take `x`: in `[1,2,3,4,5,5,6,7]`, starting `4,5,6` strands the second 5, while extending `1,2,3` works. Do not accept runs of length 1 or 2; every subsequence needs at least 3 values.

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
