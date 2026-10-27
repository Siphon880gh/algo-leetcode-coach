Each bacterial strain needs a given time to eliminate, and one white blood cell starts. A cell can either eliminate one strain (and is then used up) or split into two cells, which takes a fixed split time. Return the least total time to eliminate every strain. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Min-heap

1. Push every time into a min-heap.
2. While more than one: pop a, then b; push b + splitTime.
3. Answer the last value.

Constructed checks (run in code): [3, 1, 2], split 1 → 4; [7, 2, 2, 2], split 3 → 11; [5, 5], split 4 → 9. Checked against trying every split tree on 200 random cases.

Merging the two largest first: [1, 4, 1, 3, 6, 8], split 2 → 18 instead of 11.

Time: O(n log n)  
Space: O(n)

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
