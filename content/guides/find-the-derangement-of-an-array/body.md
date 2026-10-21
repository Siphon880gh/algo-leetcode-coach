A derangement is a permutation of `1..n` in which no element stays in its original position. Given `n` (up to `10⁶`), return the number of derangements modulo `1e9 + 7`. `n = 3` → 2 (`[2,3,1]` and `[3,1,2]`). `n = 2` → 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Where element 1 goes

Put element 1 in some position `k ≠ 1` (`n − 1` choices). Then look at element `k`:

- It goes to position 1: the two swap, and the other `n − 2` elements must be deranged → `D(n − 2)`.
- It does not go to position 1: treat position 1 as `k`'s forbidden spot, and the `n − 1` remaining elements must each avoid one spot → `D(n − 1)`.

So `D(n) = (n − 1) · (D(n − 1) + D(n − 2))` with `D(1) = 0` and `D(2) = 1`. Two rolling variables are enough. Take everything modulo `1e9 + 7`, using 64-bit products.

Do not use inclusion-exclusion with factorials and alternating signs unless you handle modular inverses; the recurrence is simpler. Do not start from `D(0) = 0`; the empty permutation counts as one derangement (`D(0) = 1`), which also makes the recurrence give `D(2) = 1`.

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
