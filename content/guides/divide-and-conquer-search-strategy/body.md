## Tiny example

Find `7` in the sorted array `a = [1, 3, 5, 7, 9]`.

1. The middle value is `5`. The target is larger, so throw away the left half.
2. The middle of the right half is `7`. Found it.

Each step cuts the search space in half. This divide-and-conquer search is binary search.

## How

1. Keep a range that still might hold the answer, such as `[lo, hi)` or `[lo, hi]`.
2. Test the middle and throw away the half that cannot contain the answer.
3. Stop when the range is empty or the middle is the target.

## Trap

Throwing away the wrong half when duplicates or exact boundaries matter.

**Fix:** Write down the rule you keep true ("the answer is inside the range") and use a boundary template when you need the first or last match.

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
