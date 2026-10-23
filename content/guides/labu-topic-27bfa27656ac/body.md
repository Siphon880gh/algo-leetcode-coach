## Tiny example

String patterns on `s="abba"`:

1. Two pointers on chars for palindrome checks
2. Sliding window with counts for “longest substring with ≤k distinct”
3. Immutable string concat in a loop → build with a buffer/builder

Byte length ≠ character length under UTF-8 (see encoding Extra).


## How

1. Prefer builders for repeated concat
2. Windows/pointers for substring constraints
3. Define your unit (byte vs code point)


## Trap

Building strings with `s += chunk` in a hot loop on immutable strings.

**Fix:** Use a list/builder then join once.

**Time:** window O(n); naive concat can be O(n²)

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
