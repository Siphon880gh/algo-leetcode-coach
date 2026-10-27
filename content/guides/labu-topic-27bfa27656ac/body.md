## Tiny example

Three string patterns, using `s = "abba"`:

1. Two pointers moving in from both ends check whether a string is a palindrome.
2. A sliding window with letter counts finds things like "the longest substring with at most k distinct letters".
3. Repeatedly adding to an immutable string in a loop is slow. Collect the pieces in a buffer or builder instead.

Also remember that under UTF-8 the length in bytes is not the number of characters. The character encoding guide covers this.

## How

1. Use a builder for repeated concatenation.
2. Use a window or two pointers for limits on substrings.
3. Decide which unit you are counting: bytes or code points.

## Trap

Building a string with `s += chunk` inside a hot loop when strings are immutable.

**Fix:** Collect the pieces in a list or builder, then join them once at the end.

**Time:** a sliding window is O(n); naive repeated concatenation can be O(n²)

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
