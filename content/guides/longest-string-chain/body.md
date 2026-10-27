## Look back one deletion

1. Sort `words` by length.
2. `best = {}`. For each `w`: `best[w] = 1`; for each position `i`, let `p = w[:i] + w[i + 1:]`; if `p` is in `best`, `best[w] = max(best[w], best[p] + 1)`.
3. Return the largest value in `best`.

Sorting by length guarantees each predecessor is processed before its successors.

Do not test every pair of words for the predecessor relation; generating deletions is O(L) candidates per word. Do not process words in input order; a predecessor may appear after its successor.

Time: O(n log n + n · L²)  
Space: O(n · L)

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
