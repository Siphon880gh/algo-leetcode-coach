## Example first

s = "aab", k = 1.

| Rotation | Equal neighbours | Score |
|----------|------------------|-------|
| "aab" | a, a | 1 |
| "aba" | none | 0 |
| "baa" | a, a | 1 |

Two rotations score 1, so the answer is 2.

## One shift changes two pairs

Moving the first character to the end only touches the ends of the string. The middle pairs stay.

1. Score the original string: count i with s[i] = s[i + 1].
2. Shift left n − 1 times. On shift t the front pair (s[t], s[t + 1]) disappears and a new end pair (s[t − 1], s[t]) appears, with indices taken mod n. Adjust the score by those two checks.
3. Count how many of the n scores equal k, including the original string.

n ≤ 100, so rebuilding every rotation also passes. The update is the cleaner habit.

## Trap

Counting the wrap pair (last character, first character) as adjacent. Every rotation of "aab" then scores 1, so Example 1 gives 3 instead of 2. Fix: only positions i and i + 1 inside the rotated string count.

Checked: examples give 2 and 1, and the update matched rebuilding every rotation on 300 random strings.

Time: O(n)  
Space: O(1)

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
