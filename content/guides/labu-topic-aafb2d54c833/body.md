## Tiny example

Greedy foundations with interval scheduling:

Intervals `(start,end)`: `(1,3),(2,4),(3,5)`. Select max non-overlapping.

Greedy: always take the interval that **ends earliest** among remaining compatible ones → pick `(1,3)` then `(3,5)`.

Needs a proof (exchange argument). Without a proof, a counterexample may exist.


## How

1. Propose a selection key
2. Sort and commit
3. Prove or find a counterexample


## Trap

Shipping greedy because it passed one sample.

**Fix:** Demand a proof sketch or a known safe pattern.

**Time:** often O(n log n) from sorting

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
