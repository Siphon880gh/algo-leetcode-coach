## Tiny example

Common hash map patterns:

| Pattern | What the map stores |
|---------|---------------------|
| Two Sum | each value seen so far, mapped to its index |
| Anagram counts | each character, mapped to its count |
| Prefix sums | each prefix sum, mapped to its first index or its count |
| Group by key | each key, mapped to a list of items |

Example, Two Sum on `[2,7,11,15]` with target 9: when you reach `7`, you need `2`. It is already in the map, so you have the pair.

## How

1. Match the problem's clue to a row.
2. Decide whether to look up before inserting or to insert before looking up.
3. Store the value you will need later: an index, a count or a list.

## Trap

Storing the wrong thing in the map, such as the value when you needed the index.

**Fix:** Write a comment like "map from X to Y" before coding.

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
