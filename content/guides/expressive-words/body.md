## Groups, not characters

Run-length encode `s` once, then each word:

- The group letters must match in order, and the number of groups must be equal.
- For each group pair with counts `c` (in `s`) and `w` (in the word):
  - `c == w`: fine.
  - `c ≥ 3` and `c ≥ w`: fine; the group was stretched to at least 3.
  - Otherwise: the word fails.

Count the words that pass.

A group of 2 in `s` cannot come from a group of 1; a stretch must reach at least 3 letters.

Do not compare characters one by one without grouping; you cannot tell stretched groups apart. Do not allow `w > c`; letters can only be added.

Time: O(|s| + Σ|word|)  
Space: O(|s|) for the groups

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
