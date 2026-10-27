## Tiny example

A warm-up before full edit distance: the distance when only deletions are allowed.

Take `a = "ab"` and `b = "a"`. Deleting `b` from `a` takes 1 edit.

Fill a table over prefixes:

- If the two characters are equal, copy the diagonal value.
- Otherwise, a deletion from either side costs 1.

This builds the same **prefix table habit** as Levenshtein distance, before you add all three operations.

## How

1. Practice longest common subsequence and delete-only tables on tiny strings.
2. Add replace and insert when you are ready for full edit distance.
3. Keep `dp[i][j]` as the answer for the prefixes of length i and j.

## Trap

Jumping into the three-operation edit distance before you are comfortable with prefix tables.

**Fix:** First master the free diagonal move for equal characters, plus one operation.

**Time:** O(mn) · **Space:** O(mn)

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
