Given a string, return the number of substrings that contain only one distinct letter. For instance, `"aaaba"` has 8 such substrings and `"aaaaaaaaaa"` has 55. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Sum over runs

1. Walk the string tracking the current run length `L`.
2. When the letter changes (or at the end), add `L · (L + 1) / 2` and reset.

Equivalently, add the current run length at every index.

`"aaaba"`: runs 3, 1, 1 → 6 + 1 + 1 = 8.

Do not enumerate all substrings; that is O(n²) or worse. Do not count only the runs; each run holds many substrings.

Time: O(n)  
Space: O(1)

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
