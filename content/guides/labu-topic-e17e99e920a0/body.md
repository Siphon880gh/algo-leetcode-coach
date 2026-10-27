## Tiny example

Hash tables are the first upgrade from nested scans.

Does `[3,1,4,1]` contain a duplicate?

- Nested loops compare every pair, which takes O(n²).
- A hash set lets you check each value and then insert it while scanning. When you reach the second `1`, it is already present, so you found a duplicate in expected O(n).

Reach for a hash table first whenever a problem asks "have I seen this before?" or "how often does this appear?".

## How

1. Create a set or a map.
2. Look up, then update. The order depends on the problem.
3. Watch out for mutable keys.

## Trap

Using a list as a "set" and calling `in` inside a loop. That is still O(n²).

**Fix:** Use a real hash set or map for membership tests.

**Time:** expected O(n) · **Space:** O(n)

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
