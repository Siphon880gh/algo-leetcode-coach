Design a class built from an initial list of numbers that supports adding a number and reporting the first number in the queue that appears exactly once, or −1 if there is none. For instance, starting from `[2,3,5]`: first unique 2; add 5 → 2; add 2 → 3; add 3 → −1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Lazy removal

1. `add(x)`: `cnt[x] += 1`; if `cnt[x] == 1`, push `x` to the queue.
2. `showFirstUnique()`: while the queue front has `cnt > 1`, pop it; return the front or −1.

Each number is pushed and popped at most once, so the work is amortised O(1).

Do not scan the whole queue on each query. An ordered set or linked hash set of uniques also works, removing a value when its count reaches 2.

Time: O(1) amortised per call  
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
