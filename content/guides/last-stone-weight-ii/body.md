## Partition, not simulation

Any smashing order ends with `|A − B|` for some split of the stones into groups `A` and `B`, and every split can be reached.

1. `total = sum(stones)`, `half = total // 2`.
2. Boolean `can[0..half]` with `can[0] = true`. For each stone `s`, for `x` from `half` down to `s`: `can[x] |= can[x − s]`.
3. `best` = the largest `x` with `can[x]`. Return `total − 2 · best`.

Loop `x` downward so each stone is used at most once.

Do not simulate with a heap as in Last Stone Weight; greedy smashing is not optimal here. A bitset (`bits |= bits << s`) is a fast way to do step 2.

Time: O(n · total)  
Space: O(total)

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
