You are given a compressed string of letter–count pairs, in which a letter may appear in several pairs and counts can have several digits. Return the better compression the statement describes, with each letter appearing once alongside its total count. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Parse and total

This assumes the output lists letters in alphabetical order; check the official statement.

1. Read a letter, then every following digit as one number; add it to that letter’s total.
2. Output each letter with its total, in order.

Constructed checks (run in code): a3c9b2c1 → a3b2c10; c2b3a1b12 → a1b15c2.

Reading one digit per count breaks multi-digit counts: c2b3a1b12 → a1b4c2.

Time: O(n)  
Space: O(26)

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
