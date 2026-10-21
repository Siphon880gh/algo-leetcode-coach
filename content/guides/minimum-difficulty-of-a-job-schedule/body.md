## Split into d contiguous days

1. If `n < d`, return −1.
2. `f(i, 1) = max(job[i:])`.
3. `f(i, k) = min over j in [i, n − k]` of `max(job[i..j]) + f(j + 1, k − 1)`, growing the running max as `j` moves.
4. Return `f(0, d)`.

`[6,5,4,3,2,1]`, d = 2 → 7. `[9,9,9]`, d = 4 → −1. `[1,1,1]`, d = 3 → 3.

Do not let a day be empty; leave at least one job for each remaining day. Do not recompute the day's max from scratch for every `j`; extend it.

Time: O(n² · d)  
Space: O(n · d)

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
