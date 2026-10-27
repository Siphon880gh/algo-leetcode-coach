Remove every positive integer that contains the digit 9 (9, 19, 29, …, 90–99, …). The remaining sequence is 1, 2, …, 8, 10, 11, …. Given `n` (up to 8 · 10⁸), return the nth number of that sequence. `n = 9` → 10. `n = 10` → 11. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Base 9 in disguise

The numbers without a 9 use only digits 0–8, and in increasing order they match base-9 counting exactly: 1, 2, …, 8, then 10, 11, …. So the nth number is `n` written in base 9, with those digits read as a decimal number.

```text
ans, place = 0, 1
while n > 0:
    ans += (n % 9) * place
    n //= 9
    place *= 10
```

Do not filter integers one by one; the nth number can be close to 10⁹. Do not convert to base 10 with digits 1–9; the digit 0 is still allowed (10 is in the sequence).

Time: O(log n)  
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
