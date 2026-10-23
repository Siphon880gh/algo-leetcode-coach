Given a list of phone numbers as digit strings, return true if no number is a prefix of another, and false otherwise. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sorted neighbors

This treats two equal numbers as prefixes of each other.

1. Sort the numbers as strings.
2. Return false if any a[i + 1] starts with a[i]; otherwise true.

Constructed checks (run in code): [12, 5, 34, 6] → true; [9, 93, 71] → false. Checked against comparing every pair on 1,000 random lists.

Sorting by length and comparing neighbors: [1, 2, 12] → true instead of false.

Time: O(n log n · L)  
Space: O(n · L)

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
