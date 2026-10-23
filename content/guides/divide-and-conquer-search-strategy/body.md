## Tiny example

Sorted `a=[1,3,5,7,9]`, find `7`.

1. Mid `5` → target larger → discard left half
2. Mid of right `7` → found

Each step halves the search space — divide-and-conquer search (binary search).


## How

1. Maintain a live range `[lo,hi)` or `[lo,hi]`
2. Test mid; discard the half that cannot hold the answer
3. Stop when range collapses or mid hits


## Trap

Discarding the wrong half when duplicates/boundaries matter.

**Fix:** Write the invariant (“answer lies in range”) and a boundary template when needed.

**Time:** O(log n) · **Space:** O(1)

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
